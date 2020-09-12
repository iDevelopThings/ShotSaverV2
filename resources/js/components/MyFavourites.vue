<template>

    <div>

        <div class="clearfix" v-if="response">
            <div class="pull-left">
                <div class="btn-group" role="group" aria-label="..." style="margin-bottom: 20px;">
                    <button type="button"
                            :disabled="paginating || (response.meta.current_page <= 1)"
                            class="btn btn-default"
                            @click="getMyFavourites('back')">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <button type="button"
                            :disabled="paginating || (response.meta.current_page >= response.meta.last_page)"
                            class="btn btn-default"
                            @click="getMyFavourites('forward')">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="pull-left" style="line-height: 36px; padding-left: 20px;">
                Page <strong>{{response.meta.current_page}}</strong> of <strong>{{response.meta.last_page}}</strong> |
                <strong>{{response.meta.total}}</strong>
                results
            </div>
            <!--<div class="pull-right">

                <div class="btn-group" role="group" aria-label="..." style="margin-bottom: 20px;">
                    <div class="btn-group">
                        <button type="button"
                                class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            Filter: <strong>Created</strong> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Created</a></li>
                            <li><a href="#">Size</a></li>
                            <li><a href="#">Type</a></li>
                            <li><a href="#">Views</a></li>
                            <li><a href="#">Favourites</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button"
                                class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            Order: <strong>Descending</strong> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Descending</a></li>
                            <li><a href="#">Ascending</a></li>
                        </ul>
                    </div>
                </div>

            </div>-->
        </div>

        <div v-if="paginating || loading"  class="text-center py-5">
            <i class="fa fa-spinner-third fa-spin fa-2x leading-loose"></i>
            <h3 class="leading-loose">Loading...</h3>
        </div>
        <div v-else >
            <div class="flex flex-col gap-6" v-if="response && response.data.length">

                <file-block :key="`upload-${upload.id}`" :upload="upload" v-for="upload in response.data"></file-block>

            </div>

            <div v-else class="text-center py-5">
                <h4>No Favourites</h4>
                <p>
                    Click the favourite button on any file to save it in this list.
                </p>
            </div>
        </div>
    </div>

</template>

<script>
	export default {
		name    : "MyFavourites",
		mounted()
		{
			this.getMyFavourites();
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

			/**
			 * Get a paginated list of the users favourites
			 */
			getMyFavourites(type = null)
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
				axios.get(`/api/favourites?page=${page}`)
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
			}

		}
	};
</script>
