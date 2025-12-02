<html>
<head>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
  <div x-data="dropdown">
    <button @click="toggle">Toggle Content</button>
 
    <div x-show="open">
        Content...
    </div>
</div>
 

</body>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,
 
            toggle() {
                this.open = ! this.open
            },
        }))
    })
</script>
</html>