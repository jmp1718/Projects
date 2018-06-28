$(document).ready(function() {
  $("#todo").focus();

  function addItem() {
    $("#todo-items").append("<li><input type='checkbox' class='done'/><span>" + $("#todo").val() + "</span><button class='delete'>Delete</button><button class='edit'>Edit</button></li>");
    $("#todo").val("");
  }
  //add item when enter is pressed
  $("#todo").keydown(function(e) {
    if (e.which == 13)
      addItem();
  });
  //add item when "Add" is clicked
  $("#add").click(addItem);

  //make textbox content editable
  $(document).on("click", '.edit', function() {
    $(this).closest("li").find("span").prop("contenteditable", true).focus();
  })
  //delete item from list
  $(document).on("click", '.delete', function() {
    $(this).closest("li").fadeOut(function() {
      $(this).remove();
    });
    return false;
  })
  //strike-through text when checkbox is checked
  $(document).on("click", '.done', function() {
    if ($(this).closest("li").find("span").css('textDecoration') === 'line-through') {
      $(this).closest("li").find("span").css('textDecoration', 'none');
    } else {
      $(this).closest("li").find("span").css('textDecoration', 'line-through');
    }
  });
  //clear all completed tasks
  $(document).on("click", '#clear', function() {
    $(".done:checked").each(function () {
      $(this).closest("li").remove();
    });
  })
  // finalize the edited span
  $(document).on("keydown", 'span[contenteditable]', function (e) {
    if (e.which == 13) {
      $(this).removeAttr("contenteditable").blur();
      return false;
    }
  });
    var data = JSON.parse(localStorage.getItem("todoData"));
    localStorage.setItem("todoData", JSON.stringify(data));
});