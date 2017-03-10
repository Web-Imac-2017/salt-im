/* @flow */

import type { PostObject, PostStateObject } from '../interfaces/post.js'

// ------------------------------------
// Constants
// ------------------------------------
export const REQUEST_POST = 'REQUEST_POST'  
export const RECIEVE_POST = 'RECIEVE_POST'  

// ------------------------------------
// Actions
// ------------------------------------

export function requestPost (): Action {  
  return {
    type: REQUEST_POST
  }
}

let availableId = 0  
export function recievePost (value: string): Action {  
  return {
    type: RECIEVE_POST,
    payload: {
      value,
      id: availableId++
    }
  }
}

export const fetchPost = (): Function => {  
  return (dispatch: Function): Promise => {
    dispatch(requestPost())

    return fetch('https://jsonplaceholder.typicode.com/')
      .then(data => data.text())
      .then(text => dispatch(recievePost(text)))
  }
}

export const actions = {  
  requestPost,
  recievePost,
  fetchPost
}

const POST_ACTION_HANDLERS = {  
  [REQUEST_POST]: (state: PostStateObject): PostStateObject => (
    { ...state, fetching: true }
  ),
  [RECIEVE_POST]: (state: PostStateObject, action: {payload: PostObject}): PostStateObject => (
    { ...state, posts: state.posts.concat(action.payload), current: action.payload.id, fetching: false }
  )
}


// ------------------------------------
// Reducer
// ------------------------------------

const initialState: PostStateObject = { fetching: false, current: null, posts: [] } 
 
export default function postReducer (state: PostStateObject = initialState, action: Action): PostStateObject {  
  const handler = POST_ACTION_HANDLERS[action.type]

  return handler ? handler(state, action) : state
}