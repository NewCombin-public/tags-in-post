document.addEventListener('DOMContentLoaded', () => {
	const $tags = new Choices(
		"#tags-in-post",
		{ 
			removeItemButton: true,
			shouldSort: false,
			noResultsText: "No hay resultados",
			noChoicesText: "No más opciones para seleccionar",
			itemSelectText: "Preciona para seleccionar",
		}
	);
});
