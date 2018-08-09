document.addEventListener('DOMContentLoaded', () => {
    const i18n = {
        restart: 'Restart',
        rewind: 'Rewind {seektime}s',
        play: 'Play',
        pause: 'Pause',
        fastForward: 'Forward {seektime}s',
        seek: 'Seek',
        seekLabel: '{currentTime} of {duration}',
        played: 'Played',
        buffered: 'Buffered',
        currentTime: 'Current time',
        duration: 'Duration',
        volume: 'Volume',
        mute: 'Mute',
        unmute: 'Unmute',
        enableCaptions: 'Enable captions',
        disableCaptions: 'Disable captions',
        enterFullscreen: 'Enter fullscreen',
        exitFullscreen: 'Exit fullscreen',
        frameTitle: 'Player for {title}',
        captions: 'Captions',
        settings: 'Settings',
        menuBack: 'Go back to previous menu',
        speed: '再生速度',
        normal: '通常',
        quality: 'Quality',
        loop: 'Loop',
        start: 'Start',
        end: 'End',
        all: 'All',
        reset: 'Reset',
        disabled: 'Disabled',
        enabled: 'Enabled',
        advertisement: 'Ad',
        qualityBadge: {
            2160: '4K',
            1440: 'HD',
            1080: 'HD',
            720: 'HD',
            576: 'SD',
            480: 'SD',
        },
    };
  const player = new Plyr('#j-player',
      {
          controls: ['play-large', 'restart', 'play', 'rewind', 'fast-forward', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen'],
          settings: ['speed'],
          loadSprite: true,
          iconUrl: 'https://cdn.plyr.io/3.3.20/plyr.svg',
          blankUrl: 'https://cdn.plyr.io/static/blank.mp4',
          seekTime: 20,
          volume: 1,
          muted: true,
          i18n: i18n,
          tooltips: { controls: false, seek: true },
          speed: { selected: 0.75, options: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2] }
      }
  );

  $('[data-plyr="settings"]').click((e) => {
    e.preventDefault();
    const $target = $(e.target);
    $target.parent().find('form').css('display', 'none');
    $('#modal_diamond_user').modal();
  })

  $('#j-player').removeClass('hidden');
});
