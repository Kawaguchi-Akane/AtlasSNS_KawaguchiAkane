//アコーディオンメニューの動き
$('.menu-btn').click(function (event) {
  event.preventDefault();
  $(this).toggleClass('is-open');
  $(this).siblings('.menu').toggleClass('is-open');
});

//JS動くか確認用
$(function () { alert('OK!'); });
