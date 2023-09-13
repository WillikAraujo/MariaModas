
const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  slidesPerView: 1,
  autoplay: {
    delay: 5000,
  },
  stopOnLastSlide: false,
})

const BtnMenu = document.getElementById('js-btn-menu-hamburguer');
const overlay = document.querySelector('.js-overlay');


function OpenMenuMobile(){
  document.documentElement.classList.add('menu-opened');
}
function CloseMenuMobile(){
  document.documentElement.classList.remove('menu-opened');
}

BtnMenu.addEventListener('click', OpenMenuMobile);
overlay.addEventListener('click', CloseMenuMobile);

class Gallery{
  constructor(){
    this.gallery = document.querySelector('[data-gallery="gallery"]');
    this.galleryList = document.querySelectorAll('[data-gallery="list"]');
    this.galleryMain = document.querySelector('[data-gallery="main"]');

    this.changeImage = this.changeImage.bind(this);
  }

  changeImage({currentTarget}) {
    this.galleryMain.src = currentTarget.src;
  }
  addChangeEvent(){
    this.galleryList.forEach(img => {
      img.addEventListener('click', this.changeImage);
      img.addEventListener('mouseover', this.changeImage);
    })
  }

  init(){
    if(this.gallery){
      this.addChangeEvent();
    }
  }
}

const gallery = new Gallery();
gallery.init();