/* @flow */
import ../../Tag/interfaces/tag.js

export type PostObject = {  
  id: number,
  title: string,
  description: string,
  tags: Array<TagObject>
}

export type PostStateObject = {  
  current: ?number,
  fetching: boolean,
  saved: Array<number>,
  posts: Array<PostObject>
}

