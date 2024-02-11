const addmodal = document.querySelector('.add-modal');
const editmodal = document.querySelector('.edit-modal');
const addModal = document.querySelector('.add-button');
const editModal = document.querySelector('.edit-button');
const closeAdd = document.querySelector('.Aclose-button');
const closeEdit = document.querySelector('.Eclose-button');

addModal.addEventListener("click", () => {
  addmodal.showModal();
});

editModal.addEventListener("click", () => {
  editmodal.showModal();
});

closeAdd.addEventListener("click", () => {
  addmodal.close();
});

closeEdit.addEventListener("click", () => {
  editmodal.close();
});