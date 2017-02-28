//call des reducers

import { combineReducers } from 'redux'
import posts from './posts'


const listPosts = combineReducers({
  posts,
  visibilityFilter
})

export default listPosts