let allCards = document.querySelectorAll(".article_card");
let navLinks = document.querySelectorAll(".filter-link");
let allHidden = document.querySelector(".no-found");

navLinks.forEach(link => {
	link.addEventListener("click", () => {
		let allCardsHidden = true;

		allCards.forEach(card => {
			if (!card.children[0].children[1].children[2].innerText.includes(link.innerText)) {
				card.hidden = true;
			} else {
				card.hidden = false;
				card.style.display = 'flex';
			}

			if (link.innerText == "Tous") {
				card.hidden = false;
				card.style.display = 'flex';
			}
		});

		allCards.forEach(card => {
			if (!card.hidden) {
				allCardsHidden = false;
				card.style.display = 'flex';
			}
		});

		if (allCardsHidden == true) {
			allHidden.style.display = 'block';
		} else {
			allHidden.style.display = 'none';
		}
	});
});