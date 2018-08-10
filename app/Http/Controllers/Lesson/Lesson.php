<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\Base;
use App\Models\Lesson\Lesson as LessonModel;
use App\Models\Media as MediaModel;
use App\Models\MsCategory as MsCategoryModel;
use App\Models\User\UserLesson as UserLessonModel;
use App\Models\User\UserLessonDetail as UserLessonDetailModel;
use App\Http\Requests\Lesson\GetFilter;

use Auth;
use Storage;

class Lesson extends Base
{
    public function __construct(
        LessonModel $lesson_model,
        UserLessonDetailModel $user_lesson_detail_model,
        UserLessonModel $user_lesson_model
    ) {
        $this->model = $lesson_model;
        $this->user_lesson_model = $user_lesson_model;
        $this->user_lesson_detail_model = $user_lesson_detail_model;
    }

    public function getLesson(GetFilter $request)
    {
        $fitler = $request->all();

        $lessons = $this->model->getLessons($fitler);
        $lesson_id = data_get($lessons, '*.id');
        if ($lessons) {
            $lessons = $this->lessonStat($lessons, $lesson_id);
            $lessons = $this->groupLesson($lessons);
        }

        $filter_form = $this->form($fitler);

        return $this->render('lesson.index', compact('lessons', 'filter_form'));
    }

    private function lessonStat(array $lessons = [], array $lesson_id_list = []) {
        $lesson_user_count_list = $this->user_lesson_model->countUserByLessonIdList($lesson_id_list);

        $user_id = Auth::id() ?: 0;
        $data = $this->user_lesson_detail_model->getByLessonId($user_id, $lesson_id_list);

        $lesson_detail_close_list = [];
        foreach ($data as $item) {
            $lesson_id = $item['lesson_id'];
            $user_lesson_detail_mode = $item['mode'];
            if (empty($lesson_detail_close_list[$lesson_id])) {
                $lesson_detail_close_list[$lesson_id] = 0;
            }
            if ($user_lesson_detail_mode == USER_LESSON_DETAIL_MODE_CLOSE) {
                $lesson_detail_close_list[$lesson_id]++;
            }
        }

        foreach($lessons as &$item) {
            $lesson_id = $item['id'];
            $item['lesson_learning_count'] = $lesson_user_count_list[$lesson_id] ?? 0;
            $item['lesson_detail_close_count'] = $lesson_detail_close_list[$lesson_id] ?? 0;
        }

        return $lessons;
    }

    private function form(array $input_value = [])
    {
        $model = new MsCategoryModel();
        $category = $model->getList();

        $difficulty = config('master.lesson.difficulty');
        return compact('category', 'difficulty', 'input_value');
    }

    private function groupLesson(array $lessons = []) {
        $result = [];
        foreach ($lessons as $item) {
            $difficulty = $item['difficulty'];
            $category = $item['category_id'];

            if (!isset($result[$difficulty])) {
                $result[$difficulty] = [
                    $category => []
                ];
            } elseif (!isset($result[$difficulty][$category])) {
                $result[$difficulty][$category] = [];
            }
            array_push($result[$difficulty][$category], $item);
        };

        return $result;
    }

    public function getDetail($lesson_id)
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        if ($user_id) {
            if (!$this->user_lesson_model->enrolled($user_id, $lesson_id)) {
                $this->user_lesson_model->enroll($user_id, $lesson_id);
            }
        }

        $target = $this->model->getLessonByLessonId($lesson_id);
        if ($target) {
            $media = $this->getMedia($target);
            $target = $this->format($target, $media, $user_id);
        }

        $filter_form = $this->form();
        $stat = $this->user_lesson_model->getStat([$lesson_id]);
        return $this->render('lesson.detail', compact('target', 'stat', 'filter_form'));
    }

    private function getMedia($lessons)
    {
        $media_id = data_get($lessons, 'lesson_details.*.source_code_contents.*.media_id');

        $tmp = (new MediaModel)->retrieve($media_id);
        $media = [];
        foreach ($tmp as $index => $item) {
            $media[$item['id']] = $item;
        }

        return $media;
    }

    private function format(array $lesson, $media, $user_id)
    {
        $storage = Storage::disk('media');
        $lesson_details = $lesson['lesson_details'];

        foreach ($lesson_details as $key => $detail) {
            $lesson_details[$key]['is_closeable'] = $user_id
                    && !$this->user_lesson_detail_model->closed($user_id, $detail['lesson_id'], $detail['id']);

            if (empty($detail['source_code_contents'])) {
                $detail['source_code_contents'] = [];
            } else {
                foreach ($detail['source_code_contents'] as $index => $item) {
                    $path = $media[$item['media_id']]['path'] ?? '';
                    if ($path && $storage->exists($path)) {
                        $item['filename'] = $media[$item['media_id']]['original_name'];
                        $item['content'] = $storage->get($path);
                        $lesson_details[$key]['source_code_contents'][$index] = $item;
                    } else {
                        unset($detail['source_code_contents'][$index]);
                        unset($lesson_details[$key]['source_code_contents'][$index]);
                    }
                }
            }

            $lesson_details[$key]['popup'] = $detail['source_code_contents'] ||
                                            $detail['resources'];
        }

        $lesson['lesson_details'] = $lesson_details;
        return $lesson;
    }

    public function getEnroll($lesson_id)
    {
        $user_id = Auth::user()->id;

        if (!$this->user_lesson_model->enrolled($user_id, $lesson_id)) {
            $this->user_lesson_model->enroll($user_id, $lesson_id);
        }

        return $this->back('lesson.detail', ['lesson_id' => $lesson_id]);
    }

    public function getClose($lesson_id)
    {
        $user_id = Auth::user()->id;

        if (!$this->user_lesson_model->closed($user_id, $lesson_id)) {
            $this->user_lesson_model->close($user_id, $lesson_id);
        }

        return $this->back('lesson.detail', ['lesson_id' => $lesson_id]);
    }
}
