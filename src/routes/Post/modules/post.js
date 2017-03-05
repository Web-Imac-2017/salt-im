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

export function requestPost(): Action {  
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

// tmp json

const dataListPost = [
    {
        "id":0,
        "type":"link",
        "url":"http://internetactu.blog.lemonde.fr/2017/02/19/apres-lintelligence-artificielle-lintelligence-etendue/",
        "title":"Super title putaclic",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":19,
        "pepper":20,
        "tags":["boisson","mere","buzz"],
        "date":"12 jan. 2017",
        "author":"Thomas Lerouô"
    },
    {
        "id":1,
        "type":"image",
        "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
        "title":"Super title putaclic sa mère",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":18,
        "pepper":20,
        "tags":["boisson","mere"],
        "date":"12 jan. 2017",
        "author":"Thomas Lerouô"
    }
]

export const fetchPost = (): Function => {  
  return (dispatch: Function): Promise => {
    dispatch(requestPost())

    return fetch(dataListPost)
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
  [REQUEST_POST]: (state: PostStateObject): PostStateObject => {
    return ({ ...state, fetching: true })
  },
  [RECIEVE_POST]: (state: PostStateObject, action: {payload: PostObject}): PostStateObject => {
    return ({ ...state, posts: state.posts.concat(action.payload), current: action.payload.id, fetching: false })
  }
}


// ------------------------------------
// Reducer
// ------------------------------------

const initialState: PostStateObject = { fetching: false, current: null, posts: [], saved: [] }  
export default function postReducer (state: PostStateObject = initialState, action: Action): PostStateObject {  
  const handler = POST_ACTION_HANDLERS[action.type]

  return handler ? handler(state, action) : state
}