import PostView from './components/PostView'
import { injectReducer } from '../../store/reducers'

export default (store) => ({  
	path: 'post',
	getComponent (nextState, next) { 
  		(require) => {
    		const Post = require('./components/PostView').default
     
     		injectReducer(store, {
        		key: 'post',
        		reducer: postReducer
     		})

      		next(null, Post)
    	}
    }
})
