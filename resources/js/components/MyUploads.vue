<template>

    <div>

        <div class="flex flex-row items-center justify-content-between py-4" v-if="response">
            <div class="">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button"
                            :disabled="paginating || (response.meta.current_page <= 1)"
                            class="btn btn-default"
                            @click="getUploads('back')">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <button type="button"
                            :disabled="paginating || (response.meta.current_page >= response.meta.last_page)"
                            class="btn btn-default"
                            @click="getUploads('forward')">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div style="">
                Page <strong>{{response.meta.current_page}}</strong> of <strong>{{response.meta.last_page}}</strong> |
                <strong>{{response.meta.total}}</strong>
                results
            </div>
            <div class="">
                <div class="btn-group" role="group" aria-label="...">
                    <div class="btn-group">
                        <button type="button"
                                class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            Filter: <strong>{{this.filterText()}}</strong> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="hover:bg-gray-800">
                                <a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white"
                                   href="javascript:;"
                                   @click="changeFilter('created')">Created</a></li>
                            <li class="hover:bg-gray-800">
                                <a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white"
                                   href="javascript:;"
                                   @click="changeFilter('size')">Size</a></li>
                            <li class="hover:bg-gray-800">
                                <a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white"
                                   href="javascript:;"
                                   @click="changeFilter('type')">Type</a></li>
                            <li class="hover:bg-gray-800">
                                <a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white"
                                   href="javascript:;"
                                   @click="changeFilter('views')">Views</a></li>
                            <li class="hover:bg-gray-800">
                                <a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white"
                                   href="javascript:;"
                                   @click="changeFilter('favourites')">Favourites</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button"
                                class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            Order: <strong>{{filters.order === 'desc' ? 'Descending' : 'Ascending'}}</strong> <span
                                class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="hover:bg-gray-800"><a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white" href="javascript:;" @click="changeOrder('desc')">Descending</a></li>
                            <li class="hover:bg-gray-800"><a class="px-2 py-2 block hover:no-underline hover:text-gray-300 text-white" href="javascript:;" @click="changeOrder('asc')">Ascending</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="paginating || loading" class="text-center py-5">
            <i class="fa fa-spinner-third fa-spin fa-2x leading-loose"></i>
            <h3 class="leading-loose">Loading...</h3>
        </div>
        <div v-else>
            <div class="flex flex-col gap-6" v-if="response && response.data.length">

                <file-block :key="`upload-${upload.id}`" :upload="upload" v-for="upload in response.data"></file-block>

            </div>

            <div v-else class="text-center py-5">
                <h4>No Uploads</h4>
                <p>
                    You have not uploaded any files yet.
                </p>
            </div>
        </div>
    </div>

</template>

<script>
	export default {
		name : "MyUploads",
		mounted()
		{
			this.getUploads();
		},
		data()
		{
			return {
				response   : null,
				paginating : false,
				loading    : false,
				error      : null,
				page       : 1,

				uploadToPreview : null,

				filters : {
					filter : 'created',
					order  : 'desc',
				}
			};
		},

		methods : {

			changeFilter(filter)
			{
				this.filters.filter = filter;
				this.response       = null;
				this.page           = 1;
				this.getUploads();
			},

			changeOrder(filter)
			{
				this.filters.order = filter;
				this.response      = null;
				this.page          = 1;
				this.getUploads();
			},

			/**
			 * Get a paginated list of the users uploads
			 */
			getUploads(type = null)
			{
				let page = this.page;

				if (type === 'forward') {
					if (this.response && this.response.meta.last_page === page) return;
					page++;
					this.paginating = true;

				} else if (type === 'back') {
					if (page === 1) return;

					page--;
					this.paginating = true;
				}

				this.loading = true;
				axios.get(`/api/files?page=${page}&order_by=${this.filters.filter}&order=${this.filters.order}`)
					.then(response => {
						this.response   = response.data;
						this.page       = parseInt(response.data.meta.current_page);
						this.loading    = false;
						this.paginating = false;
					})
					.catch(error => {
						this.error      = 'Failed to load uploads. Please try again later or contact support.';
						this.loading    = false;
						this.paginating = false;
					});
			},

			filterText()
			{
				switch (this.filters.filter) {
					case "created":
						return "Created";
					case "size":
						return "Size";
					case "type":
						return "Type";
					case "views":
						return "Views";
					case "favourites":
						return "Favourites";
				}
			}

		}
	};
</script>
