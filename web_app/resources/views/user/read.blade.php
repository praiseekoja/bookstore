<!DOCTYPE html>
<html>
<head>
  <title>{{ $book->title }}</title>
  <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
</head>
<body>
  <canvas id="pdf-canvas"></canvas>

  <script>
    var url = {{ $book->book_file }};

    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function(pdf) {
      pdf.getPage(1).then(function(page) {
        var scale = 1.5;
        var viewport = page.getViewport({scale: scale});

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
