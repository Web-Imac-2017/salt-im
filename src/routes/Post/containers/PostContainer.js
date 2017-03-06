import { connect } from 'react-redux'  
import { fetchPost } from '../modules/post'

import PostView from '../components/PostView'

import type { PostObject } from '../interfaces/post'

const mapActionCreators: {fetchPost: Function} = {  
  fetchPost
}

const mapStateToProps = (state): { post: ?PostObject} => ({  
  post: state.post.posts.find(post => post.id === state.post.current)
})

export default connect(mapStateToProps, mapActionCreators)(PostView)  