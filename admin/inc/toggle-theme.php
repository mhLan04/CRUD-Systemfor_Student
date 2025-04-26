<!-- Toggle Switch for Dark/Light Mode -->
<div id="themeToggleContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <label class="switch">
        <input type="checkbox" id="themeToggle">
        <span class="slider round"></span>
    </label>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
/* Switch Styles */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "\f185"; /* Sun icon */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    color: gold;
    transition: 0.4s;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

input:checked + .slider {
    background-color: #4f46e5;
}

input:checked + .slider:before {
    transform: translateX(26px);
    content: "\f186"; /* Moon icon */
    color: #fff;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    if (localStorage.getItem('theme') === 'dark') {
        $('body').addClass('dark-mode');
        $('#themeToggle').prop('checked', true);
    }

    $('#themeToggle').on('change', function() {
        if ($(this).is(':checked')) {
            $('body').addClass('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            $('body').removeClass('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
});
</script>
