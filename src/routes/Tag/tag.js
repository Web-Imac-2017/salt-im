/* @flow */

export type TagObject = {  
  id: number,
  title: string,
  picUrl: string,
  link: string
}

export type TagStateObject = {  
  current: ?number,
  fetching: boolean,
  saved: Array<number>,
  tags: Array<TagObject>
}

