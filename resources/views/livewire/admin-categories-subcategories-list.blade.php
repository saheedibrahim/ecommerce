<div>
    <div class="row">
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-category')}}" class="btn btn-primary btn-sm" type="button">
                            <i class="bi bi-plus"></i>
                            Add Category
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless table-stripped">
                         <thead class="bg-secondary text-white">
                            <tr>
                                <th>Category image</th>
                                <th>Category name</th>
                                <th>No of sub categories</th>
                                <th>Actions</th>
                            </tr>
                         </thead>
                         <tbody class="table-border-bottom-0" id="sortable_categories">
                            @forelse ($categories as $item)
                                <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}" wire:key="category-{{ $item->id }}" wire:sortable.item="{{ $item->id }}">
                                    <td>
                                        <div class="avatar mr-2">
                                            <img src="/images/categories/{{ $item->category_image}}" width="50" height="50" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->category_name }}
                                    </td>
                                    <td>
                                        {{ $item->subcategories->count() }}
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('admin.manage-categories.edit-category', 
                                            ['id' => $item->id])}}" class="text-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="javascript:;" class="text-danger deleteCategoryBtn" data-id="{{ $item->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">No category found!</span>
                                    </td>
                                </tr>
                            @endforelse
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Sub Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-subcategory')}}" class="btn btn-primary btn-sm" type="button">
                            <i class="bi bi-plus"></i>
                            Add Sub Category
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless table-stripped">
                         <thead class="bg-secondary text-white">
                            <tr>
                                <th>Sub Category name</th>
                                <th>Category name</th>
                                <th>Child Sub Categories</th>
                                <th>Actions</th>
                            </tr>
                         </thead>
                         <tbody class="table-border-bottom-0" id="sortable_subcategories">
                            @forelse ($subcategories as $item)
                            <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                                <td>
                                    {{ $item->subcategory_name }}
                                </td>
                                <td>
                                    {{ $item->parentcategory->category_name }}
                                </td>
                                <td>
                                    @if ($item->children->count() > 0)
                                    <ul class="list-group" id="sortable_child_subcategories">
                                        @foreach ($item->children as $child)
                                            <li class="d-flex justify-content-between" data-index="{{ $child->id }}" data-ordering="{{ 
                                            $child->ordering }}" class="d-flex 
                                            justify-content-between align-items-center">
                                                -{{ $child->subcategory_name }}
                                                <div>
                                                    <a href="{{ route('admin.manage-categories.edit-subcategory', 
                                                    ['id' => $child->id]) }}" class="text-primary"
                                                    data-toggle="tooltip" title="Edit child sub category">Edit</a>
                                                    |
                                                    <a href="javascript:;" class="text-danger deleteChildSubCategoryBtn"
                                                    data-toggle="tooltip" title="Delete child sub 
                                                    category" data-id="{{ $child->id }}" data-title="Child Sub Category">Delete</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.manage-categories.edit-subcategory', ['id' => $item->id]) }}" class="text-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="javascript:;" class="text-danger deleteSubCategoryBtn" 
                                        data-id="{{ $item->id }}" data-title="Sub Category">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>                                
                            @empty
                                <tr>
                                    <td>
                                        <span class="text-danger">No sub category found!</span>
                                    </td>
                                </tr>
                            @endforelse
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>    
    $('table tbody#sortable_categories').sortable({
        cursor: "move",
        update: function (event, ui) {
            $(this).children().each(function (index) {
                if ($(this).attr("data-ordering") != (index + 1)) {
                    $(this).attr("data-ordering", (index + 1)).addClass("updated");
                }
            });

            var positions = [];
            $(".updated").each(function () {
                positions.push([$(this).attr("data-index"), $(this).attr("data-ordering")]);
                $(this).removeClass("updated");
            });

            // ✅ This is correct for Livewire 3
            @this.call('updateCategoriesOrdering', positions);
        }
    });
    
    $('table tbody#sortable_subcategories').sortable({
        cursor: "move",
        update: function (event, ui) {
            $(this).children().each(function (index) {
                if ($(this).attr("data-ordering") != (index + 1)) {
                    $(this).attr("data-ordering", (index + 1)).addClass("updated");
                }
            });

            var positions = [];
            $(".updated").each(function () {
                positions.push([$(this).attr("data-index"), $(this).attr("data-ordering")]);
                $(this).removeClass("updated");
            });

            // ✅ This is correct for Livewire 3
            @this.call('updateSubCategoriesOrdering', positions);
        }
    });
    
    $('ul#sortable_child_subcategories').sortable({
        cursor: "move",
        update: function (event, ui) {
            $(this).children().each(function (index) {
                if ($(this).attr("data-ordering") != (index + 1)) {
                    $(this).attr("data-ordering", (index + 1)).addClass("updated");
                }
            });

            var positions = [];
            $(".updated").each(function () {
                positions.push([$(this).attr("data-index"), $(this).attr("data-ordering")]);
                $(this).removeClass("updated");
            });

            // ✅ This is correct for Livewire 3
            @this.call('updateChildSubCategoriesOrdering', positions);
        }
    });

    $(document).on('click', '.deleteCategoryBtn', function(e){
        e.preventDefault();
        var category_id = $(this).data('id');
        alert(category_id);
    })
</script>