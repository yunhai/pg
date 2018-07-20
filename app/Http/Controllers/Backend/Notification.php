<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Notification\PostInput;
use App\Models\Backend\Notification as NotificationModel;

class Notification extends Base
{
    public function __construct(
        NotificationModel $notification_model
    ) {
        $this->model = $notification_model;
    }

    public function getIndex()
    {
        $data = $this->model->orderBy('id', 'desc')->paginate(20);
        $form = $this->form();
        return $this->render('notification.index', compact('data', 'form'));
    }

    public function getEdit($id)
    {
        $target = $this->model->get($id);
        $form = $this->form();
        return $this->render('notification.input', compact('target', 'form'));
    }

    public function postEdit(PostInput $request, $id)
    {
        $input = $request->all();
        $this->model->edit($id, $input);

        return redirect()->route('backend.notification.index');
    }

    public function getCreate()
    {
        $form = $this->form();
        return $this->render('notification.input', compact('form'));
    }

    public function postCreate(PostInput $request)
    {
        $input = $request->all();
        $target = $this->model->create($input);

        return redirect()->route('backend.notification.index');
    }

    public function getDelete($id)
    {
        $this->model->destroy($id);
        return redirect()->route('backend.notification.index');
    }

    protected function form()
    {
        return [
        ];
    }
}
