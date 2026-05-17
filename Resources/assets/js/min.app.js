//require("@/bootstrap");


import VideoIndex from "./../../views/VideoIndex.vue"

import VideoEdit from "./../../views/VideoEdit.vue"
 

window.router.addRoute({ path: '/videos', component: VideoIndex, name: "module.videos.index"})

window.router.addRoute({ path: '/videos/create', component: VideoEdit, name: "module.videos.create" })

window.router.addRoute({ path: '/videos/:id/edit', component: VideoEdit, name: "module.videos.edit", props: true})

