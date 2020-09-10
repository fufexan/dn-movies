function img_err(image) {
  image.onerror = null;
  image.src = 'inc/img/placeholder.png';
  return true;
}
