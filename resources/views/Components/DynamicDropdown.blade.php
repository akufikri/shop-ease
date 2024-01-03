{{-- cdn --}}
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
{{-- cdn --}}

<ul class="py-2 text-sm text-gray-700 dark:text-gray-200 drpdwn" aria-labelledby="dropdownDefaultButton">
    <li>
        <a href="#"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
    </li>
</ul>

{{-- script --}}
<script>
    $(document).ready(() => {
        dynamicDropdown()
    });

    function dynamicDropdown() {
        $.ajax({
            type: "GET",
            url: "/kategori/get",
            success: function(response) {
                var katCon = $('.drpdwn');
                katCon.empty();

                // console.log(response)

                if (response && Array.isArray(response.data)) {
                    response.data.forEach(function(kategori) {
                        var katElement = `
                            <li>
                                 <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">${kategori.name}</a>
                            </li>
                            `;
                        katCon.append(katElement);
                    })
                }
            }
        });
    }
</script>
{{-- script --}}
