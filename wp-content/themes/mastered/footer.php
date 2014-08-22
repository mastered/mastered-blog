		<footer class="blog-footer-wrap">
			<div class="layout-width blog-footer">
				<p class='copyright-footer'>&copy; Mastered &mdash; Turning Makers into Masters.</p>
				<ul class='footer-sitemap'>
				<li><a href="https://mastered.com/">Home</a></li>
				<li><a href="https://mastered.com/pages/purpose">About Us</a></li>
				<li><a href="https://mastered.com/pages/terms-of-service">Terms Of Service</a></li>
				<li><a href="https://mastered.com/pages/faq">How It Works</a></li>
				<li><a href="https://mastered.com/pages/contact">Contact Us</a></li>
				</ul>
			</div>
		</footer>
	<?php wp_footer(); // js scripts are inserted using this function ?>
	<script type="text/javascript">
	// Crazily large script that MailChimp insists on using

	var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';
	try {
	    var jqueryLoaded=jQuery;
	    jqueryLoaded=true;
	} catch(err) {
	    var jqueryLoaded=false;
	}
	var head= document.getElementsByTagName('head')[0];
	if (!jqueryLoaded) {
	    var script = document.createElement('script');
	    script.type = 'text/javascript';
	    script.src = '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
	    head.appendChild(script);
	    if (script.readyState && script.onload!==null){
	        script.onreadystatechange= function () {
	              if (this.readyState == 'complete') mce_preload_check();
	        }    
	    }
	}

	var err_style = '';
	try{
	    err_style = mc_custom_error_style;
	} catch(e){
	    err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
	}
	var head= document.getElementsByTagName('head')[0];
	var style= document.createElement('style');
	style.type= 'text/css';
	if (style.styleSheet) {
	  style.styleSheet.cssText = err_style;
	} else {
	  style.appendChild(document.createTextNode(err_style));
	}
	head.appendChild(style);
	setTimeout('mce_preload_check();', 250);

	var mce_preload_checks = 0;
	function mce_preload_check(){
	    if (mce_preload_checks>40) return;
	    mce_preload_checks++;
	    try {
	        var jqueryLoaded=jQuery;
	    } catch(err) {
	        setTimeout('mce_preload_check();', 250);
	        return;
	    }
	    var script = document.createElement('script');
	    script.type = 'text/javascript';
	    script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
	    head.appendChild(script);
	    try {
	        var validatorLoaded=jQuery("#fake-form").validate({});
	    } catch(err) {
	        setTimeout('mce_preload_check();', 250);
	        return;
	    }
	    mce_init_form();
	}
	function mce_init_form(){
	    jQuery(document).ready( function($) {
	      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
	      var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
	      $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
	      options = { url: 'http://mastered.us2.list-manage1.com/subscribe/post-json?u=7c024eafab829ad0f5e4ed2a2&id=64419d76ab&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
	                    beforeSubmit: function(){
	                        $('#mce_tmp_error_msg').remove();
	                        $('.datefield','#mc_embed_signup').each(
	                            function(){
	                                var txt = 'filled';
	                                var fields = new Array();
	                                var i = 0;
	                                $(':text', this).each(
	                                    function(){
	                                        fields[i] = this;
	                                        i++;
	                                    });
	                                $(':hidden', this).each(
	                                    function(){
	                                        var bday = false;
	                                        if (fields.length == 2){
	                                            bday = true;
	                                            fields[2] = {'value':1970};//trick birthdays into having years
	                                        }
	                                    	if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
	                                    		this.value = '';
										    } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
	                                    		this.value = '';
										    } else {
										        if (/\[day\]/.test(fields[0].name)){
	    	                                        this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
										        } else {
	    	                                        this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
		                                        }
		                                    }
	                                    });
	                            });
	                        $('.phonefield-us','#mc_embed_signup').each(
	                            function(){
	                                var fields = new Array();
	                                var i = 0;
	                                $(':text', this).each(
	                                    function(){
	                                        fields[i] = this;
	                                        i++;
	                                    });
	                                $(':hidden', this).each(
	                                    function(){
	                                        if ( fields[0].value.length != 3 || fields[1].value.length!=3 || fields[2].value.length!=4 ){
	                                    		this.value = '';
										    } else {
										        this.value = 'filled';
		                                    }
	                                    });
	                            });
	                        return mce_validator.form();
	                    }, 
	                    success: mce_success_cb
	                };
	      $('#mc-embedded-subscribe-form').ajaxForm(options);
	      
	      
	    });
	}
	function mce_success_cb(resp){
	    $('#mce-success-response').hide();
	    $('#mce-error-response').hide();
	    if (resp.result=="success"){
	        $('#mce-'+resp.result+'-response').show();
	        $('#mce-'+resp.result+'-response').html(resp.msg);
	        $('#mc-embedded-subscribe-form').each(function(){
	            this.reset();
	    	});
	    } else {
	        var index = -1;
	        var msg;
	        try {
	            var parts = resp.msg.split(' - ',2);
	            if (parts[1]==undefined){
	                msg = resp.msg;
	            } else {
	                i = parseInt(parts[0]);
	                if (i.toString() == parts[0]){
	                    index = parts[0];
	                    msg = parts[1];
	                } else {
	                    index = -1;
	                    msg = resp.msg;
	                }
	            }
	        } catch(e){
	            index = -1;
	            msg = resp.msg;
	        }
	        try{
	            if (index== -1){
	                $('#mce-'+resp.result+'-response').show();
	                $('#mce-'+resp.result+'-response').html(msg);            
	            } else {
	                err_id = 'mce_tmp_error_msg';
	                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
	                
	                var input_id = '#mc_embed_signup';
	                var f = $(input_id);
	                if (ftypes[index]=='address'){
	                    input_id = '#mce-'+fnames[index]+'-addr1';
	                    f = $(input_id).parent().parent().get(0);
	                } else if (ftypes[index]=='date'){
	                    input_id = '#mce-'+fnames[index]+'-month';
	                    f = $(input_id).parent().parent().get(0);
	                } else {
	                    input_id = '#mce-'+fnames[index];
	                    f = $().parent(input_id).get(0);
	                }
	                if (f){
	                    $(f).append(html);
	                    $(input_id).focus();
	                } else {
	                    $('#mce-'+resp.result+'-response').show();
	                    $('#mce-'+resp.result+'-response').html(msg);
	                }
	            }
	        } catch(e){
	            $('#mce-'+resp.result+'-response').show();
	            $('#mce-'+resp.result+'-response').html(msg);
	        }
	    }
	}

	</script>
  <script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
    olark_identity = "4975-530-10-1482";
    olark_contact_url = "https://www.olark.com/site/4975-530-10-1482/contact";
    f[z]=function(){
    (a.s=a.s||[]).push(arguments)};var a=f[z]._={
    },q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
    f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
    0:+new Date};a.P=function(u){
    a.p[u]=new Date-a.p[0]};function s(){
    a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
    hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
    return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
    b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
    b.contentWindow[g].open()}catch(w){
    c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
    var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
    b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
    loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
    /* custom configuration goes here (www.olark.com/documentation) */
    olark.identify(olark_identity);/*]]>*/
  </script>
  <noscript>
    <a href=olark_contact_url title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a>
  </noscript>

	</body>
</html>
