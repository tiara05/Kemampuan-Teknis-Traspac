const ajax_preloader = `<div class="d-flex justify-content-center align-items-center"><div class="spinner-border text-danger spinner-border-lg" role="status"></div></div>`;
const ajax_on_type_delay = 500;

function ajaxRenderTo(target_selector, route, method = "get") {
    let target = $(target_selector);
    $.ajax({
        type: method,
        url: route,
        beforeSend: function () {
            target.html(ajax_preloader);
        },
        success: function (response) {
            target.html(response);
        },
    });
}
$(document).on("click", ".ajax_modal_btn", function () {
    let self = $(this);
    let modal_selector = self.data('modal-selector') ?? '#common-modal';
    let modal = $(modal_selector);
    modal.find("#modal_title").text(self.data("modal-title"));
    let modal_size = self.data("modal-size");
    console.log("Showing modal: " + modal_selector);
    modal.modal("show");
    ajaxRenderTo(modal_selector+" #content", self.data("render-route"), "get");
});

$(document).on("click", ".ajax_offcanvas_btn", function () {
    let self = $(this);
    let offcanvas = $("#common-offcanvas");
    offcanvas.find(".offcanvas-title").text(self.data("offcanvas-title"));
    offcanvas.offcanvas("show");
    ajaxRenderTo("#common-offcanvas .offcanvas-body", self.data("render-route"), "get");
});

$(document).on("click", ".ajax_confirm_btn", function () {
    let self = $(this);
    let route = self.data("route");
    let method = self.data("method") ?? "POST";
    let text =
        self.data("text") ?? "Apakah Anda yakin melanjutkan tindakan ini ?";
    let after_submit = self.data("after-submit") ?? "reload";
    alertify
        .confirm(
            "Konfirmasi",
            text,
            function () {
                $.ajax({
                    method: method,
                    url: route,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (after_submit === "reload") {
                            location.reload();
                        } else if (after_submit === "alert") {
                            alertify.success(response.message);
                        }
                    },
                    error: function (response) {
                        alertify.error(response.responseJSON.message);
                    },
                });
            },
            function () {
                // alertify.error("Aksi dibatalkan");
            }
        )
        .set("labels", { ok: "Yes", cancel: "Cancel" });
});

var submit_loading = false;
$(document).on("submit", ".ajax_form", function (event) {
    event.preventDefault();
    let form = $(this);
    let action = form.attr("action");
    let method = form.attr("method");
    let formData = new FormData(this);

    let modal = form.closest(".modal");
    let btn = form.find('button[type="submit"]');
    let btn_html = btn.html();
    let spinner =
        btn_html +
        '<span class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>';

    if (submit_loading) {
        return false;
    }

    $.ajax({
        url: action,
        type: method,
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            btn.html(spinner);
            form.find(".form-control")
                .removeClass("border-danger")
                .attr("title", "");
            form.find(".form-select")
                .removeClass("border-danger")
                .attr("title", "");

            let inputfile_id = form.find(`input[type="file"]`).attr("id");
            form.find(`.upload_file[data-target-input="#${inputfile_id}"]`)
                .removeClass("border-danger")
                .attr("title", "");

            submit_loading = true;
        },
        success: function (response) {
            if (form.data("after-submit") == "reload") {
                location.reload();
            } else if (form.data("after-submit") == "close-modal") {
                modal.modal("hide");
                btn.html(btn_html);
            }
        },
        error: function (response) {
            const code = response.status;
            const message = response.responseJSON.message;
            const data = response.responseJSON.data;
            if (code == 422) {

                $.each(data, function (i, v) {

                    let inputField = form.find(`[name="${i}"]`);
                    let errorText = inputField.next(".text-danger");
                    let inputfile_id = inputField.attr("id");

                    inputField.addClass("border-danger").attr("title", v[0]);
                    if (!errorText.length) {
                        inputField.after(`<small class="text-danger">${v[0]}</small>`);
                    } else {
                        errorText.text(v[0]);
                    }
                    inputField.on('input', function () {
                        $(this).removeClass("border-danger").attr("title", "");
                        $(this).next(".text-danger").remove();
                    });
                    form.find(`.upload_file[data-target-input="#${inputfile_id}"]`)
                        .addClass("border-danger")
                        .attr("title", v[0]);

                    // jika multiple file upload
                    // var pattern = /\.\d+/g;
                    // if (pattern.test(i)) {
                    //     var id_clean = i.replace(/\.\d+/g, "");
                    //     let inputfile_id = form.find(`input[type="file"][id="${id_clean}"]`).attr("id");
                    //     form.find(`input[type="file"][id="${inputfile_id}"]`)
                    //     .addClass("border-danger")
                    //     .attr("title", v[0]);
                    // }

                    // form.find(`[name="${i}"]`).addClass("border-danger").attr("title", v[0]);
                    // let inputfile_id = form.find(`input[type="file"][id="${i}"]`).attr("id");
                    // form.find(`input[type="file"][id="${i}"]`)
                    // .addClass("border-danger")
                    // .attr("title", v[0]);
                    // form.find(`.upload_file[data-target-input="#${inputfile_id}"]`)
                    //     .addClass("border-danger")
                    //     .attr("title", v[0]);
                });

                // handle error inputan multiple files
                let errors_multiple_file_uploads = {};

                $.each(data, function (i, v) {
                    let match = i.match(/^(.+)\.\d+$/);
                    if (match) {
                        let baseName = match[1];
                        if (!errors_multiple_file_uploads[baseName]) {
                            errors_multiple_file_uploads[baseName] = [];
                        }
                        errors_multiple_file_uploads[baseName].push(v[0]);
                    }
                });

                $.each(errors_multiple_file_uploads, function (baseName, errors) {
                    let inputField = form.find(`[name="${baseName}[]"]`);
                    if (inputField.length) {
                        let errorText = inputField.next(".text-danger");
                        let errorMessage = errors.join('<br>');
                        if (!errorText.length) {
                            inputField.after(`<small class="text-danger">${errorMessage}</small>`);
                        } else {
                            errorText.html(errorMessage);
                        }
                        inputField.addClass("border-danger").attr("title", errors[0]);
                        inputField.on('change', function () {
                            $(this).removeClass("border-danger").attr("title", "");
                            $(this).next(".text-danger").remove();
                        });
                    }
                });

            } else {
                alertify.error(message);
            }
            btn.html(btn_html);
        },
        complete: function () {
            submit_loading = false;
        },
    });
});

function ajaxAfterFormSubmit(config) {
    $(document).ajaxComplete(function (event, xhr, settings) {
        var currentUrl = settings.url;
        var checkUrls = config.expect_url;
        var expectedMethods = config.expect_method;
        var isUrlMatch = checkUrls.some(function (url) {
            return currentUrl.indexOf(url) !== -1;
        });
        var isMethodMatch = expectedMethods.includes(
            settings.type.toUpperCase()
        );
        if (xhr.status === 200 && isUrlMatch && isMethodMatch) {
            config.callback();
        }
    });
}
