$(() => {
    $('.j-goback').click(e => {
        const $target = $(e.target);
        const url = $target.data('url');

        if (url) {
            window.location = url;
            return true;
        }

        if (history.length === 1) {
            window.location = '/admin';
            return true;
        }

        history.back();
    });

    $('.j-mode11').hide();
    $('.j-mode00').hide();
});
