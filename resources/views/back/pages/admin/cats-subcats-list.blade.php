@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @livewire('admin-categories-subcategories-list')
@endsection

{{-- @push('scripts')
    <script>
        $('table tbody#sortable_categories').sortable({
            cursor: "move",
            update: function(event,ui){
                $(this).children().each(function(index){
                    if ($(this).attr("data-ordering") != (index+1)) {
                        $(this).attr("data-ordering", (index+1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function(){
                    positions.push([$(this).attr("data-index"),$(this).attr("data-ordering")]);
                    $(this).removeClass("updated");
                });
                // alert(positions);
                window.livewire.emit('updateCategoriesOrdering', positions);
            }
        });
    </script>
@endpush --}}


@push('scripts')
<script>
     $(document).on('click', '.deleteCategoryBtn', function(e){
        e.preventDefault();
        var category_id = $(this).data('id');
        // alert(category_id);
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to delete this category',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtontext: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            width: 300,
            allowOutsideClick: false
        }).then(function(result){
            if (result.value) {
                // alert('Yes, delete category');
                window.livewire.emit('deleteCategory', category_id);
            }
        });
    });

    
    $(document).on('click', '.deleteSubCategoryBtn,.deleteChildSubCategoryBtn', function(e){
        e.preventDefault();
        var subcategory_id = $(this).data("id");
        var title = $(this).data("title");
        // alert("title: " + title + 'ID: ' + subcategory_id);
        swal.fire({
            title: 'Are you sure',
            html: 'You want to delete this <b>'+title+'</b>',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtontext: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            width: 300,
            allowOutsideClick: false
        }).then(function(result){
            if (result.value) {
                // alert('Yes, Delete sub category');
                window.livewire.emit("deleteSubCategory", subcategory_id);
            }
        })
    });
</script>
@endpush
