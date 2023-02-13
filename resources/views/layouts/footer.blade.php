<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<footer class="footer footer-static footer-light">
  <p class="clearfix mb-0"><span class="float-left d-inline-block">2023 &copy; {{ env('APP_NAME') }} 1.0</span>
    {{-- <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button> --}}
  </p>
</footer>


<!-- BEGIN: Vendor JS-->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('js/core/libraries/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
<script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
<script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
@yield('vendor-scripts')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('js/scripts/configs/horizontal-menu.js')}}"></script>
<script src="{{asset('js/core/app-menu.js')}}"></script>
<script src="{{asset('js/core/app.js')}}"></script>
<script src="{{asset('js/scripts/components.js')}}"></script>
<script src="{{asset('js/scripts/footer.js')}}"></script>
<script src="{{asset('js/dropify/dropify.min.js')}}"></script>
<script src="{{asset('js/scripts/mask/cleave.min.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.dropify').dropify();
  });
</script>
<!-- END: Theme JS-->

<!-- BEGIN: Web Notification -->
<script>
  const notif_count = $("#notif_count")
  const notif_content = $("#notif_content")
  const notif_title_count = $("#notif_title_count")
  const target = "1";
  
  const Echo = new window.Echo({
    broadcaster: "pusher",
    key: "{{ env('PUSHER_APP_KEY') }}",
    wsHost: "{{ env('WS_HOST') }}",
    wsPort: "{{ env('WS_PORT') }}",
    wssPort: "{{ env('WSS_PORT') }}",
    forceTLS: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss']
  });

  Echo.channel('web-notification').listen('WebNotification', (e) => {
    const notifications = e.data.target.filter(x => x == target)
    const content = `
      <a class="d-flex justify-content-between" href="{{ url('/${e.data.content.notif_url}') }}">
        <div class="media d-flex align-items-center">
          <div class="media-left pr-0">
            <div class="avatar bg-rgba-danger m-0 mr-1 p-25">
              <div class="avatar-content"><i class="bx bx-detail text-danger"></i></div>
            </div>
          </div>
          <div class="media-body">
            <h6 class="media-heading"><span class="text-bold-500">${e.data.content.title},</span> ${e.data.content.message.toLowerCase()}</h6>
            <small class="notification-text">${e.data.content.time}</small>
          </div>
        </div>
      </a>
    `

    for (const v of notifications) {
        const nc = parseInt(notif_count.text(), 10) + 1;

        notif_count.text(nc);
        notif_title_count.text(nc);
        notif_content.prepend(content)
    }
  });
</script>
<!-- END: Web Notification -->

<script>
  const api = "{{ env('APP_URL') }}"  
</script>

<!-- BEGIN: Page JS-->
@yield('page-scripts')
<!-- END: Page JS-->

@stack('scripts')