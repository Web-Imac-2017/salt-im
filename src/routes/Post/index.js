import { injectReducer } from '../../store/reducers'

export default (store) => ({  
  path: 'post',
  
  getComponent (nextState, next) {
    
    require.ensure([], (require) => {
      const Post = require('./containers/PostContainer').default
      const postReducer = require('./modules/post').default

      injectReducer(store, {key: 'post', reducer: postReducer})

      next(null, Post)
    }, 'post')
  }
})