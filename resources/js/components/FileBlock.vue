<template>
    <a :href="`/file/${upload.name}`" class="block relative group flex flex-row bg-gray-900 hover:bg-gray-800 hover:no-underline group-hover:no-underline duration-150 ease-in-out transition-all cursor-pointer border-gray-800 overflow-hidden shadow-md hover:shadow-2xl rounded-lg">

        <div class="absolute top-0 right-0 shadow-md  rounded-bl-lg flex flex-row overflow-hidden">
            <div class="flex flex-col  px-2 bg-blue-700">
                <p class=" text-xs mb-0 font-semibold text-gray-200 leading-loose tracking-wide uppercase">
                    {{upload.type}}
                </p>
            </div>
            <div class="flex flex-col  px-2 bg-gray-700">
                <p class=" text-xs mb-0 font-semibold text-gray-200 leading-loose tracking-wide uppercase">
                    {{upload.views}} View{{upload.views === 1 ? '' : 's'}}</p>
            </div>
            <div class="flex flex-col px-2 bg-purple-600">
                <p class=" text-xs mb-0 font-semibold text-white leading-loose tracking-wide uppercase ">
                    {{upload.total_favourites}} Favourite{{upload.total_favourites === 1 ? '' : 's'}}</p>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 shadow-md rounded-tl-lg flex flex-row overflow-hidden">
            <a href="javascript:;"
               v-if="upload.is_mine"
               @click="remove(upload)"
               :disabled="upload.deleting"
               :class="{'opacity-50 cursor-not-allowed' : upload.deleting }"

               class="px-3 hover:no-underline text-xs mb-0 font-semibold bg-red-500 hover:bg-red-600 text-red-100 hover:text-white leading-loose tracking-wide uppercase ">
                <template v-if="upload.deleting" >
                    <i class="fa fa-spinner mr-1 fa-spin"></i>
                </template>
                <template v-else >
                    <i class="fa fa-trash mr-1"></i>
                </template>
                delete
            </a>
            <a href="javascript:;"
               @click="favourite(upload)"
               :disabled="upload.favouriting"
               :class="{'opacity-50 cursor-not-allowed' : upload.favouriting, 'bg-purple-600 hover:bg-purple-600 text-purple-100 hover:text-white' : upload.favourited, 'bg-purple-400 hover:bg-purple-400 text-purple-700 hover:text-purple-800' : !upload.favourited }"
               class=" px-3  hover:no-underline text-xs mb-0 font-semibold leading-loose tracking-wide uppercase ">
                <template v-if="upload.favouriting" >
                    <i class="fa fa-spinner mr-1 fa-spin"></i>
                </template>
                <template v-else >
                    <i v-if="upload.favourited" class="fa text-red-200 fa-heart mr-1 animated heartBeat"></i>
                    <i v-else class="fa fa-heart-o mr-1"></i>
                </template>
                Favourite
            </a>
        </div>

        <div class="bg-center bg-cover bg-no-repeat w-2/12 opacity-75 group-hover:opacity-100"
             :style="{'background-image' : `url(${upload.thumb})`}">

        </div>

        <div class="flex flex-row px-4 py-8 gap-6 align-items-center w-full">

            <div class="flex flex-col text-xs flex-1">
                <a :href="`/file/${upload.name}`"
                   class="font-semibold leading-loose text-gray-100 group-hover:text-gray-300 hover:no-underline">
                    {{upload.name}}
                </a>
                <p class="mb-0 font-light text-gray-400 leading-loose uppercase">{{upload.created_at |
                                                                                 from}}</p>
            </div>


            <div class="flex flex-col text-xs ">
                <p class="mb-0 font-semibold text-gray-200 leading-loose">{{upload.size}}</p>
                <p class="mb-0 font-light text-gray-400 leading-loose uppercase">File Size</p>
            </div>
            <div class="flex flex-col text-xs flex-1">
                <p class="mb-0 font-semibold text-gray-200 leading-loose">{{upload.private ? 'Private' :
                                                                          'Public'}}</p>
                <p class="mb-0 font-light text-gray-400 leading-loose uppercase">Privacy</p>
            </div>

        </div>
    </a>
</template>

<script>
	export default {
		name    : "FileBlock",
        props : ['upload'],
		mounted()
		{
		},
		data()
		{
			return {};
		},
		methods : {
			favourite(upload)
			{
				this.$set(upload, 'favouriting', true);
				axios.post(`/api/files/${upload.id}/favourite`)
					.then(response => {
						upload.favourited       = response.data.favourited ? 1 : 0;
						upload.total_favourites = response.data.total_favourites;
					})
					.catch(error => {
					})
					.finally(() => {

						this.$set(upload, 'favouriting', false);
					})

			},

			remove(upload)
			{
				if (!confirm('Are you sure you want to delete this file?')) return;

				this.$set(upload, 'deleting', true)

				axios.post(`/api/files/${upload.id}/delete`)
					.then(response => {
						let index = this.response.data.indexOf(upload);
						this.response.data.splice(index, 1);
					})
					.catch(error => {
						this.response.data.splice(index, 1, upload);
					})
					.finally(() => {
						this.$set(upload, 'deleting', false)
					});
			}
		}
	};
</script>

<style scoped lang="scss">

</style>