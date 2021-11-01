$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open');
    $('.navbar').toggleClass('menu-open')  
  })
})

$(function () {
  'use strict'

  $('[data-toggle="offcanvas2"]').on('click', function () {
    $('.offcanvas-collapse2').toggleClass('open');
    $('.side-nav').toggleClass('menu-open')
  })
})
