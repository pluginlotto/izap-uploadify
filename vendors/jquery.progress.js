var uploadProgressSettings=new Array();
var uploadProgressTimer=new Array();
var uploadProgressNotFound=new Array();
var uploadProgressActive=new Array();
var uploadProgressData=new Array();
jQuery.fn.extend({
  uploadProgress:function(c){
    var a=jQuery('input[name="UPLOAD_IDENTIFIER"]',this);
    if(!c.id&&a.length){
      c.id=a.val()
      }
      if(!c.id){
      c.id=b(c.keyLength)
      }
      if(a.length){
      a.val(c.id)
      }else{
      jQuery('<input type="hidden" name="UPLOAD_IDENTIFIER"/>').val(c.id).prependTo(this)
      }
      c=jQuery.extend({
      dataFormat:"json",
      updateDelay:500,
      notFoundLimit:10,
      debugDisplay:false,
      progressDisplay:".upload-progress",
      progressMeter:".meter",
      targetUploader:"jqUploader",
      fieldPrefix:".",
      displayFields:["est_sec"],
      start:function(){},
      success:function(){},
      failed:function(){}
    },c);
  uploadProgressSettings[c.id]=c;
  jQuery(this).submit(function(){
    if(uploadProgressActive[c.id]){
      return false
      }
      uploadProgressActive[c.id]=true;
    var e=this;
    c.start.call(e);
    jQuery(e).attr("target",c.targetUploader);
    var d=jQuery('<iframe id="'+c.targetUploader+'" name="'+c.targetUploader+'"></iframe>');
    if(c.debugDisplay){
      $("iframe#"+c.targetUploader).remove();
      $(c.debugDisplay).after(d)
      }else{
      d.css({
        position:"absolute",
        top:"-500px",
        left:"-500px"
      }).appendTo("body")
      }
      d.load(function(){
      clearTimeout(uploadProgressTimer[c.id]);
      if(c.progressMeter){
        jQuery(c.progressMeter).width(jQuery(c.progressDisplay).width()-20)
        }
        c.success.call(e,c);
      if(!c.debugDisplay){
        setTimeout(function(){
          try{
            d.remove()
            }catch(f){}
        },100)
      }
      uploadProgressActive[c.id]=false
    });
  uploadProgressTimer[c.id]=window.setTimeout("jQuery.uploadProgressUpdate('"+c.id+"')",c.updateDelay);
    uploadProgressNotFound[c.id]=0;
    return true
    });
return this;
function b(d){
  if(!d){
    d=11
    }
    var h="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  var g="";
  for(var f=0;f<d;f++){
    var e=Math.floor(Math.random()*(h.length+1));
    g+=h.charAt(e)
    }
    return g
  }
}
});
jQuery.extend({
  uploadProgressUpdate:function(c){
    var b=uploadProgressSettings[c];
    var a=new Date().getTime();
    jQuery.ajax({
      url:b.progressURL,
      data:{
        upload_id:c,
        stamp:a
      },
      success:function(g){
        if(g.error){
          if(b.debugDisplay){
            jQuery(b.debugDisplay).append("<p>UP: "+g.error+"</p>")
            }
            uploadProgressNotFound[c]++;
          if(uploadProgressNotFound[c]>=b.notFoundLimit){
            b.failed.call();
            return false
            }
          }else{
        uploadProgressData[c]=g;
        if(b.debugDisplay){
          var f="";
          for(var i in g){
            f+=i+": "+g[i]+"<br />"
            }
            jQuery(b.debugDisplay).html(f)
          }
          if(b.progressMeter){
          var e=(jQuery(b.progressDisplay).width()-20)/g.bytes_total;
          jQuery(b.progressMeter).width(g.bytes_uploaded*e)
          }
          for(var h=0;h<b.displayFields.length;h++){
          jQuery(b.fieldPrefix+b.displayFields[h],b.progressDisplay).html(g[b.displayFields[h]])
          }
        }
        if(uploadProgressActive[c]){
      uploadProgressTimer[c]=window.setTimeout("jQuery.uploadProgressUpdate('"+c+"')",b.updateDelay)
      }
    },
  dataType:b.dataFormat,
  error:function(f,d,e){
    if(b.debugDisplay){
      jQuery(b.debugDisplay).append("<p>XHR: "+d+"</p>")
      }
      b.failed.call();
    return false
    }
  })
}
});