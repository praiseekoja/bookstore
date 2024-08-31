<!DOCTYPE html>
<html>

<head>
    <title>{{ $book->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf_viewer.min.css"
        integrity="sha512-5cOE2Zw/F4SlIUHR/xLTyFLSAR0ezXsra+8azx47gJyQCilATjazEE2hLQmMY7xeAv/RxxZhs8w8zEL7dTsvnA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ url('assets/js/vendor/pdf.min.js') }}"></script>
    <script src="{{ url('assets/js/vendor/pdf.worker.min.js') }}"></script>
</head>

<body>
    <canvas id="pdf-canvas"></canvas>

    <script>
        var url = '{{ url($book->book_file) }};'

        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                var scale = 1.5;
                var viewport = page.getViewport({
                    scale: scale
                });

                var canvas = document.getElementById('pdf-canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        });

        // Disable right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>
</body>

</html>
