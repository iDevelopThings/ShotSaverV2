<template>

    <div>

        <div class="clearfix" v-if="response">
            <div class="pull-left">
                <div class="btn-group" role="group" aria-label="..." style="margin-bottom: 20px;">
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

        <ul class="list-unstyled file-list" v-if="response && response.data.length">
            <li class="file-item" v-for="upload in response.data" :class="upload.loadingState ? 'disabled-state' : ''">


                <div class="thumb">

                    <a href="javascript:;"
                       class="pull-left favourite-button"
                       @click="favourite(upload)"
                       v-if="!upload.loadingState">
                        <i :class="upload.favourited === 1 ? 'fas fa-star' : 'far fa-star'"></i>
                    </a>
                    <i v-else style="margin-left: 22px;" class="fa fa-spinner fa-spin"></i>


                    <img :src="upload.thumb"
                         class="img-responsive center-block "
                         alt=""
                         style="width: 65px;">
                </div>
                <div class="upload-name">
                    <a :href="`/file/${upload.name}`">
                        <strong>{{upload.name}}</strong>
                    </a>
                    <span>Uploaded: <strong>{{upload.created_at |from}}</strong></span>


                </div>
                <div class="stats">
                    <div class="">
                        Views: <strong>{{upload.views}}</strong>
                    </div>
                    <div>
                        Favourites:
                        <strong>{{upload.total_favourites}}</strong>
                    </div>
                </div>
                <div class="size">
                    <div class="">{{upload.size}}</div>
                    <div>
                        File Type: <strong>{{upload.extension}}</strong>
                    </div>
                </div>
                <div class="size">
                    Privacy: <strong>{{upload.private ? 'Private' : 'Public'}}</strong>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                        <button type="button"
                                class="btn btn-primary"
                                @click="preview(upload)"
                                :disabled="upload.loadingState">
                            <i class="fa fa-eye"></i> View
                        </button>
                        <button type="button"
                                class="btn btn-default"
                                @click="remove(upload)"
                                :disabled="upload.loadingState">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>

                </div>

            </li>
        </ul>
        <div v-else class="text-center py-5">
            <h4>No Uploads</h4>
            <p>
                You have not uploaded any files yet.
            </p>
        </div>
    </div>

</template>

<script>
    export default {
        name    : "MyUploads",
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

                console.log(page);

                this.loading = true;
                axios.get(`/api/files?page=${page}`)
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
                    })
            },

            preview(upload)
            {
                window.location = '/file/' + upload.name;
            },

            favourite(upload)
            {
                this.$set(upload, 'loadingState', true);
                upload.loadingState = true;
                axios.post(`/api/files/${upload.id}/favourite`)
                    .then(response => {
                        upload.favourited       = response.data.favourited ? 1 : 0;
                        upload.total_favourites = response.data.total_favourites;
                    })
                    .catch(error => {
                    })
                    .finally(() => {

                        this.$set(upload, 'loadingState', false);
                    })

            },

            remove(upload)
            {
                if (!confirm('Are you sure you want to delete this file?')) return;

                let index = this.response.data.indexOf(upload);
                this.response.data.splice(index, 1);

                axios.post(`/api/files/${upload.id}/delete`)
                    .then(response => {

                    })
                    .catch(error => {
                        this.response.data.splice(index, 1, upload);
                    })
            }

        }
    }
</script>
