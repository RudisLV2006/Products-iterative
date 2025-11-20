document.addEventListener("DOMContentLoaded", function () {
    const tagsInput = document.getElementById("tags");
    const tagList = document.getElementById("tagList");

    // Funkcija, kas iegūst atbilstošos tagus no servera
    async function fetchTags(term) {
        try {
            const response = await fetch(`/tags/search?term=${term}`);
            const data = await response.json();
            console.log("Fetched tags:", data); // Debugging
            return data;
        } catch (error) {
            console.error("Error fetching tags:", error);
            return [];
        }
    }

    // Pievienot autocomplete funkcionalitāti
    tagsInput.addEventListener("input", async function () {
        const term = tagsInput.value.trim();
        if (term.length > 0) {
            const suggestions = await fetchTags(term);
            showSuggestions(suggestions);
        } else {
            hideSuggestions();
        }
    });

    // Rādīt priekšlikumus
    function showSuggestions(suggestions) {
        hideSuggestions();
        if (suggestions.length > 0) {
            const suggestionList = document.createElement("ul");
            suggestionList.classList.add("autocomplete-suggestions");

            suggestions.forEach((tag) => {
                const listItem = document.createElement("li");
                listItem.textContent = tag;
                listItem.addEventListener("click", function () {
                    addTag(tag);
                    hideSuggestions();
                });
                suggestionList.appendChild(listItem);
            });
            tagsInput.parentElement.appendChild(suggestionList);
        }
    }

    // Paslēpt priekšlikumus
    function hideSuggestions() {
        const existingSuggestions = document.querySelector(
            ".autocomplete-suggestions"
        );
        if (existingSuggestions) {
            existingSuggestions.remove();
        }
    }

    // Pievienot tagu sarakstam
    function addTag(tag) {
        const listItem = document.createElement("li");
        listItem.textContent = tag;
        const removeButton = document.createElement("button");
        removeButton.textContent = "X";
        removeButton.classList.add("removeTag");
        listItem.appendChild(removeButton);
        tagList.appendChild(listItem);

        removeButton.addEventListener("click", () => {
            listItem.remove();
        });
    }

    // Apstrādāt formu nosūtīšanu ar AJAX
    const form = document.getElementById("addTagsForm");
    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const tags = [];
        tagList.querySelectorAll("li").forEach((item) => {
            tags.push(item.textContent.replace(" X", ""));
        });

        const formData = new FormData();
        formData.append(
            "_token",
            document.querySelector('input[name="_token"]').value
        );
        formData.append("tags", tags.join(","));

        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
            });

            if (response.ok) {
                alert("Tagi veiksmīgi pievienoti!");
                form.reset();
                tagList.innerHTML = ""; // Clear the tag list
            } else {
                alert("Radās problēma pievienojot tagus.");
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            alert("Radās problēma pievienojot tagus.");
        }
    });
});
