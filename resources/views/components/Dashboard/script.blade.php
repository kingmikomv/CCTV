
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('DHS/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('DHS/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('DHS/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('DHS/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('DHS/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('DHS/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('DHS/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('DHS/assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.tiny.cloud/1/r5cn3d2shecyvxexv792iye7i9v67rckejxhekw9cnpq2f1a/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#deskripsi',
    height: 200,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste help wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | \
              alignleft aligncenter alignright alignjustify | \
              bullist numlist outdent indent | removeformat | help'
  });
</script>
