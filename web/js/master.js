
   var keys = function(element, index, array) {
      var selector;
      if (!element) {
        return false;
      }
      selector = $("#servicesList").find("label[data-id=" + element + "]");
      selector.find("input").prop("checked", true);
      return selector.find("i").addClass("checked");
    };


 $(document).on("click", ".servicesListPopUp .cancel", function() {
     return $(this).parents(".servicesListPopUp").removeClass("block");
 });

 $(document).on("click", ".servicesListPopUp .save", function() {
     userServicesID = "";
     usersServicesList = "";
     $("#servicesList .last input").each(function() {
         if ($(this).prop("checked")) {
             userServicesID += $(this).parent("label").attr("data-id") + ", ";
             return usersServicesList += "<span class=\"tag\" data-tag=\"" + $(this).parent("label").attr("data-id") + "\">" + $(this).parent("label").text() + "<i></i></span>";
         }
     });
     $('.userServices').find(".tag").remove();
     $('#servicesListInput').attr('data-servece-ids', userServicesID);
     $(this).parents(".servicesListPopUp").removeClass("block");
     return $('.userServices').append(usersServicesList);
 });
 $(document).on("click", ".newTag", function() {
    var newArray;
     $("#servicesList input").prop("checked", false);
     $("#servicesList i").removeClass("checked");
     newArray = $('#servicesListInput').attr('data-servece-ids').split(",");
     console.log(newArray)
     newArray.forEach(keys);
     return $(".servicesListPopUp").addClass("block");
 });
 $("#servicesList span").click(function() {
     $(this).parent().toggleClass("open");
 });
 $("#servicesList li ul li").click(function() {
     if ($(this).find("input").prop("checked")) {
         $(this).find("i").addClass("checked");
     } else {
         $(this).find("i").removeClass("checked");
     }
 });
 $("#servicesList i").click(function() {
     if (!$(this).siblings("input").prop("checked") && !$(this).parent().parent().hasClass("last")) {
         $(this).addClass("checked");
         $(this).parent().find("input").prop("checked", true);
         $(this).parent().find("i").addClass("checked");
     } else if ($(this).siblings("input").prop("checked") && !$(this).parent().parent().hasClass("last")) {
         $(this).removeClass("checked");
         $(this).parent().find("input").prop("checked", false);
         $(this).parent().find("i").removeClass("checked");
     }
 });
 $(document).on("click", ".tag i", function() {
     var arr;
     arr = $(this).parent(".tag").siblings(".tag");
     userServicesID = "";
     arr.each(function() {
         userServicesID += $(this).attr("data-tag") + ",";
     });
     $('#servicesListInput').attr('data-servece-ids', userServicesID);
     $(this).parent(".tag").remove();
 });