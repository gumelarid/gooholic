<footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto">
            made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://github.com/gumelarid">gumelarid</a>
        </div>
    </div>
</footer>
</div>

</div>



<!--   Core JS Files   -->
<script src="{{ url('assets') }}./js/core/jquery.3.2.1.min.js"></script>
<script src="{{ url('assets') }}./js/core/popper.min.js"></script>
<script src="{{ url('assets') }}./js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{ url('assets') }}./js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{ url('assets') }}./js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ url('assets') }}./js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="{{ url('assets') }}./js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{ url('assets') }}./js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{ url('assets') }}./js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{ url('assets') }}./js/plugin/datatables/datatables.min.js"></script>

<!-- Atlantis JS -->
<script src="{{ url('assets') }}./js/atlantis.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
        });
    });

    
</script>

<script type="text/javascript">
      
    $(document).ready(function (e) {
        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview-image-before-upload').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
     
</script>

<script>
   @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>


</body>
</html>