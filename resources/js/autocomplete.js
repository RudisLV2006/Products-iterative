document.addEventListener("DOMContentLoaded", function () {
    const tagsInput = document.getElementById("tags");
    const tagList = document.getElementById("tagList");

    // Function to fetch matching tags from the server
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

    // Add autocomplete functionality
    tagsInput.addEventListener("input", async function () {
        const term = tagsInput.value.trim();
        if (term.length > 0) {
            const suggestions = await fetchTags(term);
            showSuggestions(suggestions);
        } else {
            hideSuggestions();
        }
    });

    // Handle Enter key press
    tagsInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault(); // Prevent form submission
            const inputValue = tagsInput.value.trim();

            if (inputValue.length > 0) {
                // Check if input contains commas
                if (inputValue.includes(",")) {
                    // Split by comma and add each tag
                    const tags = inputValue
                        .split(",")
                        .map((tag) => tag.trim())
                        .filter((tag) => tag.length > 0);
                    tags.forEach((tag) => addTag(tag));
                } else {
                    // Add single tag
                    addTag(inputValue);
                }
                hideSuggestions();
            }
        }
    });

    // Show suggestions
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

    // Hide suggestions
    function hideSuggestions() {
        const existingSuggestions = document.querySelector(
            ".autocomplete-suggestions"
        );
        if (existingSuggestions) {
            existingSuggestions.remove();
        }
    }

    // Add tag to the list (with remove button)
    function addTag(tag) {
        // Check if tag already exists
        const existingTags = Array.from(
            tagList.querySelectorAll(".tag-name")
        ).map((el) => el.textContent);
        if (existingTags.includes(tag)) {
            return; // Don't add duplicate
        }

        const listItem = document.createElement("li");

        // Create a span for the tag text
        const tagText = document.createElement("span");
        tagText.textContent = tag;
        tagText.classList.add("tag-name");

        // Create remove button
        const removeButton = document.createElement("button");
        removeButton.textContent = "X";
        removeButton.classList.add("removeTag");

        // Append both to the list item
        listItem.appendChild(tagText);
        listItem.appendChild(removeButton);

        // Append the tag to the list
        tagList.appendChild(listItem);

        // Add event listener for removing the tag
        removeButton.addEventListener("click", () => {
            listItem.remove();
        });

        // Clear the input field after adding the tag
        tagsInput.value = "";
    }

    // Handle form submission (via AJAX)
    const form = document.getElementById("addTagsForm");
    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        const tags = [];
        tagList.querySelectorAll("li").forEach((item) => {
            // Get only the tag name span text
            const tagName = item.querySelector(".tag-name");
            if (tagName) {
                tags.push(tagName.textContent);
            }
        });

        const formData = new FormData();
        formData.append(
            "_token",
            document.querySelector('input[name="_token"]').value
        );
        formData.append("tags", tags.join(",")); // Join tags with commas

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
                const errorResponse = await response.text();
                console.error("Error:", errorResponse);
                alert("Radās problēma pievienojot tagus.");
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            alert("Radās problēma pievienojot tagus.");
        }
    });
});
