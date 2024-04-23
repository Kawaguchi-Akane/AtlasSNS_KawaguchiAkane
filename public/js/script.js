//アコーディオンメニューの動き
$('.menu-btn').click(function () {
  $(this).toggleClass('is-open');
  $(this).siblings('.menu').toggleClass('is-open');
});

//JS動くか確認用
//$(function () { alert('OK!'); });
