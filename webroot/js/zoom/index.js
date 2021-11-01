window.addEventListener('DOMContentLoaded', function(event) {
  console.log('DOM fully loaded and parsed');
  websdkready();
});
function joinSession(i) {
	var testTool = window.testTool;
	ZoomMtg.preLoadWasm();

	var API_KEY = "B0RWdIUDR4a-7vQQ3u2Q5g";
	var API_SECRET = "QEANdwmjvawOjbaq1h0OMvcEDd6wlMi0RXe9";
	var meetingConfig = testTool.getMeetingConfig(i);
	if (!meetingConfig.mn || !meetingConfig.name) {
		alert("Meeting number or username is empty");
		return false;
	}
	
	testTool.setCookie("meeting_number", meetingConfig.mn);
	testTool.setCookie("meeting_pwd", meetingConfig.pwd);

	var signature = ZoomMtg.generateSignature({
		meetingNumber: meetingConfig.mn,
		apiKey: API_KEY,
		apiSecret: API_SECRET,
		role: meetingConfig.role,
		success: function (res) {
		  meetingConfig.signature = res.result;
		  meetingConfig.apiKey = API_KEY;
		  var joinUrl = "/sessions/session-bookings/start-meeting?" + testTool.serialize(meetingConfig);
		   window.open(joinUrl, "_blank");
		},
	});
}
function websdkready() {
  var testTool = window.testTool;
  /* if (testTool.isMobileDevice()) {
    vConsole = new VConsole();
  } */
  console.log("checkSystemRequirements");
  console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

  // it's option if you want to change the WebSDK dependency link resources. setZoomJSLib must be run at first
  // if (!china) ZoomMtg.setZoomJSLib('https://source.zoom.us/1.8.6/lib', '/av'); // CDN version default
  // else ZoomMtg.setZoomJSLib('https://jssdk.zoomus.cn/1.8.6/lib', '/av'); // china cdn option
  // ZoomMtg.setZoomJSLib('http://localhost:9999/node_modules/@zoomus/websdk/dist/lib', '/av'); // Local version default, Angular Project change to use cdn version
  ZoomMtg.preLoadWasm(); // pre download wasm file to save time.

  var API_KEY = "B0RWdIUDR4a-7vQQ3u2Q5g";

  /**
   * NEVER PUT YOUR ACTUAL API SECRET IN CLIENT SIDE CODE, THIS IS JUST FOR QUICK PROTOTYPING
   * The below generateSignature should be done server side as not to expose your api secret in public
   * You can find an eaxmple in here: https://marketplace.zoom.us/docs/sdk/native-sdks/web/essential/signature
   */
  var API_SECRET = "QEANdwmjvawOjbaq1h0OMvcEDd6wlMi0RXe9";
  
  // click join meeting button
  var list = document.getElementsByClassName('joinSession');
  for(let i=0;i<list.length;i++){
      list[i].addEventListener("click", function (e) {
          e.preventDefault();
          var meetingConfig = testTool.getMeetingConfig(i);
          if (!meetingConfig.mn || !meetingConfig.name) {
            alert("Meeting number or username is empty");
            return false;
          }
    
          
          testTool.setCookie("meeting_number", meetingConfig.mn);
          testTool.setCookie("meeting_pwd", meetingConfig.pwd);
    
          var signature = ZoomMtg.generateSignature({
            meetingNumber: meetingConfig.mn,
            apiKey: API_KEY,
            apiSecret: API_SECRET,
            role: meetingConfig.role,
            success: function (res) {
              meetingConfig.signature = res.result;
              meetingConfig.apiKey = API_KEY;
              var joinUrl = "/sessions/session-bookings/start-meeting?" + testTool.serialize(meetingConfig);
               window.open(joinUrl, "_blank");
            },
          });
      });
  }
}
