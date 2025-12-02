let debounceTimer;

// Debounce function to optimize search responsiveness
function debounceSearch() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(fetchAndDisplayTips, 300);
}

// Function to fetch tips from the database and display them
function fetchAndDisplayTips() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();

    fetch('search.php') // Ensure this path is correct
        .then(response => response.json())
        .then(data => {
            updateDisplayedItems(data, searchInput);
        })
        .catch(error => console.error('Error fetching tips:', error));
}

// Unified function to handle both search and filter
function updateDisplayedItems(tips, searchInput) {
    const filterValue = document.getElementById('filterSelect').value;
    const itemList = document.getElementById('itemList');
    itemList.innerHTML = ''; // Clear existing items

    // Only display items if there is search input
    if (searchInput === '') {
        return; // If the search input is empty, exit the function
    }

    tips.forEach(tip => {
        const itemText = tip.tip_name.toLowerCase(); // Ensure this matches your database field
        const itemCategory = tip.category;

        // Show item if it matches both the search input and the filter
        const matchesSearch = itemText.includes(searchInput);
        const matchesFilter = (filterValue === 'all' || itemCategory === filterValue);

        if (matchesSearch && matchesFilter) {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'item';
            itemDiv.setAttribute('data-category', itemCategory);
            itemDiv.textContent = `${tip.tip_name} (${itemCategory})`; // Display the tip name and category
            itemList.appendChild(itemDiv);
        }
    });
}

// Call this function when the filter changes
function filterItems() {
    fetchAndDisplayTips(); // Fetch and display tips based on the current filter and search input
}

// Optional: Uncomment this if you want to load tips when the page loads
// document.addEventListener('DOMContentLoaded', fetchAndDisplayTips);

// Attach the search event listener to the search input
document.getElementById('searchInput').addEventListener('input', debounceSearch);
