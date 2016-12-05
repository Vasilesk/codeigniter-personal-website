$( document ).ready(function() {
    $("#modal-copyright").iziModal({fullscreen: true, autoOpen: false, headerColor: "rgb(136, 160, 185);", padding: "10px"});
    $(document).on('click', '.trigger', function (event) {
    event.preventDefault();
    $('#modal-copyright').iziModal('open');
	});
});