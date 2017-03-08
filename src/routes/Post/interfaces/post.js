/* @flow */

//import ../../Tag/interfaces/tag.js

export type PostObject = {  
  id: ?number,
  title: string
  /*tags: Array<TagObject>*/
}

export type PostStateObject = {  
  current: ?number,
  fetching: boolean,
  posts: Array<PostObject>
}

