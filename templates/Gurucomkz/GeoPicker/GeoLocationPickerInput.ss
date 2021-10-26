<% if $ApiKey %>

    <script type="text/javascript">
        (function(u,w,d,s,k){
            if(d.getElementById(u)) return;
            var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s);
            j.id=u;
            j.async=true;
            j.type='text/javascript';
            j.src='https://maps.googleapis.com/maps/api/js?libraries=places&key='+k;
            f.parentNode.insertBefore(j,f);
        })('googlemapsscript',window,document,'script','$ApiKey');
    </script>

    <input type="hidden" name="$Name" id="Input_$ID" data-elid="$ID" class="geo-picker-input" value="$Value">
    <div id="Map_Wrapper_$ID" style="width:100%; height:400px;position:relative;border:1px solid black;">
        <div id="Map_$ID" style="width:100%; height:100%;"></div>
        <div style="width:1px; height:50%; left:50%;top: 25%;background:black;position:absolute;pointer-events:none;"></div>
        <div style="height:1px; width:50%; top:50%;left: 25%;background:black;position:absolute;pointer-events:none;"></div>
        <div style="position: absolute; left: 25%; bottom:15px; right:25%;">
            <input type="text" class="text" id="AC_$ID">
        </div>
    </div>
<% else %>
    <p class="message error">
        Please, set PLACES_API_KEY env var to display the map.
    </p>
    <input type="text" name="$Name" id="Input_$ID" data-elid="$ID" class="text geo-picker-input" value="$Value">
<% end_if %>
