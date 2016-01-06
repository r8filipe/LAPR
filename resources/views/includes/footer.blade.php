<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/admin/dist/js/sb-admin-2.js"></script>

<!--TOOGLE-->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap2-toggle.min.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-listVendas').DataTable({
            responsive: true
        });
        $('#dataTables-listCompras').DataTable({
            responsive: true
        });
        $('#dataTables-listBook').DataTable({
            responsive: true
        });
        $('#dataTables-listUser').DataTable({
            responsive: true
        });
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
<script>
    jQuery(function ($) {
        var fileInput = document.getElementById("files");
        console.log(fileInput);
        fileInput.addEventListener("change", function (e) {
            var files = this.files
            showThumbnail(files)
        }, false)

        function showThumbnail(files) {
            $("#thumbnail").empty();
            for (var i = 0; i < files.length; i++) {
                var file = files[i]
                var imageType = /image.*/
                if (!file.type.match(imageType)) {
                    console.log("Not an Image");
                    continue;
                }

                var image = document.createElement("img");
                // image.classList.add("")
                var thumbnail = document.getElementById("thumbnail");
                image.file = file;
                thumbnail.appendChild(image)

                var reader = new FileReader()
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;
                    };
                }(image))
                var ret = reader.readAsDataURL(file);
                var canvas = document.createElement("canvas");
                ctx = canvas.getContext("2d");
                image.onload = function () {
                    ctx.drawImage(image, 100, 100)
                }
            }
        }
    });


    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function (e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

</script>
<script>
    $(document).ready(function () {
        $(".addPublisher").hide();
        $("#publisher").change(function () {
            if ($(this).val() != 0) {
                $(".addPublisher").hide();
            } else {
                $(".addPublisher").show();
            }
        });
    });
</script>
<script>
    $(function () {
        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $("#authors")
        // don't navigate away from the field on tab when selecting an item
                .bind("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    source: function (request, response) {
                        $.getJSON("/search/getAuthors", {
                            term: extractLast(request.term)
                        }, response);
                    },
                    search: function () {
                        // custom minLength
                        var term = extractLast(this.value);
                        if (term.length < 3) {
                            return false;
                        }
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    }
                });
    });
</script>

</body>

</html>