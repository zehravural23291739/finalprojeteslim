
const commentForm = document.getElementById("commentForm");
const commentList = document.getElementById("commentList");


commentForm.addEventListener("submit", function (e) {
    e.preventDefault(); 

    const nameInput = document.getElementById("name").value;
    const commentInput = document.getElementById("comment").value;

    const newComment = document.createElement("div");
    newComment.classList.add("comment");
    newComment.innerHTML = `
        <p class="name">${nameInput}</p>
        <p>${commentInput}</p>
    `;


    commentList.appendChild(newComment);

    commentForm.reset();
});
