<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image/Video Search</title>
    <style>
        /* Add some styles */
        body {
            font-family: Arial, sans-serif;
        }

        #results {
            display: flex;
            flex-wrap: wrap;
        }

        .item {
            margin: 10px;
        }
    </style>
</head>

<body>
    <?php echo view('pages/layout/header.php'); ?>

    <h1>Search Images and Videos</h1>
    <input type="text" id="searchQuery" placeholder="Search for images or videos">
    <button id="searchBtn" class="btn  btn-primary  btn-sm">Images Search</button> &nbsp;<button id="searchBtnVideo" class="btn  btn-primary  btn-sm">Video Search</button>
    <div id="results"></div>

    <script>
        const apiKey = '46610464-f3e8db73748744a1a23cfd0f8'; // Replace with your API key
        const searchBtn = document.getElementById('searchBtn');
        const searchBtnVideo = document.getElementById('searchBtnVideo');
        const searchQuery = document.getElementById('searchQuery');
        const resultsDiv = document.getElementById('results');

        searchBtn.addEventListener('click', () => {
            const query = searchQuery.value.trim();
            if (query) {
                const url = `https://pixabay.com/api/?key=${apiKey}&q=${encodeURIComponent(query)}&image_type=photo&video_type=all&per_page=10`;
                fetchImages(url);
            }
        });
        searchBtnVideo.addEventListener('click', () => {
            const query = searchQuery.value.trim();
            if (query) {
                const url = `https://pixabay.com/api/videos/?key=${apiKey}&q=${encodeURIComponent(query)}&per_page=10`;
                fetchImages(url);
            }
        });

        async function fetchImages(url) {



            try {
                const response = await fetch(url);
                const data = await response.json();
                displayResults(data.hits);
            } catch (error) {
                console.error('Error fetching data:', error);
                resultsDiv.innerHTML = 'Failed to fetch data.';
            }
        }

        function displayResults(items) {
            resultsDiv.innerHTML = ''; // Clear previous results
            console.log(items)
            items.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('item');

                // Create an image or video element
                if (item.type === 'photo') {
                    const img = document.createElement('img');
                    img.src = item.webformatURL;
                    img.alt = item.tags;
                    img.style.width = '200px'; // Set image width
                    itemDiv.appendChild(img);
                } else if (item.type === 'film') {

                    const videoElement = document.createElement('video');
                    videoElement.src = item.videos.tiny.url; // You can choose different resolutions
                    videoElement.controls = true; // Show video controls
                    videoElement.width = 320; // Set width
                    videoElement.height = 240; // Set height

                    const title = document.createElement('p');
                    title.textContent = item.tags; // Add tags or any other info

                    resultsDiv.appendChild(videoElement);
                    resultsDiv.appendChild(title);
                }

                resultsDiv.appendChild(itemDiv);
            });
        }
    </script>
</body>

</html>