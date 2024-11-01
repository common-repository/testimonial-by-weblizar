(function ($) {
  "use strict";
  jQuery(document).ready(function () {
    try {
      $("#post").validate();
    } catch (e) {}
    $(document).on("click", "#wltp_testimonial_row_add_more", function () {
      $(".wltp_testimonial_row")
        .first()
        .clone()
        .find("input")
        .attr({ value: "" })
        .end()
        .find("textarea")
        .val("")
        .end()
        .find(".tp-photo")
        .remove()
        .end()
        .find(".tp-default.tp-hide")
        .removeClass("tp-hide")
        .end()
        .fadeIn(100, function () {
          $(this).appendTo("#wltp_testimonial_rows");
        });
    });
    $(document).on("click", ".wltp_testimonial_remove_label", function () {
      if ($(".wltp_testimonial_row").length > 1) {
        $(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .fadeOut(300, function () {
            $(this).remove();
          });
      }
    });

    $(document).on("click", ".testimonial_profile_photo_button", function (e) {
      e.preventDefault();
      var that = this;
      var mediaUploader;
      if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: "Choose Image",
        button: {
          text: "Choose Image",
        },
        multiple: false,
      });

      mediaUploader.on("select", function () {
        var attachment = mediaUploader.state().get("selection").toJSON();
        for (var i = 0; i < attachment.length; i++) {
          $(that).parent().parent().find(".tp-default").remove();
          $(that).parent().parent().find(".tp-photo").remove();
          $(that).before(
            "<div class='tp-photo'><input name='testimonial_profile_photo[]' type='hidden' value='" +
              attachment[i].url +
              "'><img src='" +
              attachment[i].url +
              "'></div>"
          );
        }
      });
      // Open the uploader dialog
      mediaUploader.open();
    });

    var gridLayout = jQuery(".wltp-testimonial_grid");
    var sliderLayout = jQuery(".wltp-testimonial_slider");

    var testimonialLayout = jQuery(
      "input[type=radio][name=layouts]:checked"
    ).val();

    gridLayout.hide();
    sliderLayout.hide();

    if (testimonialLayout == "gridLayout") {
      gridLayout.show();
    } else if (testimonialLayout == "sliderLayout") {
      sliderLayout.show();
    }

    jQuery(document).on(
      "change",
      "input[type=radio][name=layouts]",
      function () {
        if (this.value == "gridLayout") {
          sliderLayout.hide();
          gridLayout.fadeIn();
        } else if (this.value == "sliderLayout") {
          gridLayout.hide();
          sliderLayout.fadeIn();
        }
      }
    );

    jQuery(document).ready(function () {
      jQuery(".color-field").each(function () {
        jQuery(this).wpColorPicker();
      });
    });
  });
})(jQuery);
