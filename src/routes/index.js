// We only need to import the modules necessary for initial render
import CoreLayout from '../layouts/CoreLayout'
import Home from './Home'
import Post from './Post'
import Tags from './Tags'
import PostCreator from './PostCreator'
import TagCreator from './TagCreator'
import Tag from './Tag'
import Profile from './Profile'
import Authentification from './Authentification'
import Signup from './Signup'
import Page404 from './Page404'

/*  Note: Instead of using JSX, we recommend using react-router
    PlainRoute objects to build route definitions.   */

const postRoute = {
  path: 'post/:postId',
  indexRoute: Post
}

const tagsRoute = {
  path: 'tags',
  indexRoute: Tags
}

let CreatePostRoute = {
  path: 'post/create',
  indexRoute: PostCreator
}

let CreateTagRoute = {
  path: 'tag/create',
  indexRoute: TagCreator
}
const tagRoute = {
  path: 'tag/:tagId',
  indexRoute: Tag
}

const profileRoute = {
  path: 'profile',
  indexRoute: Profile
}

const authentificationRoute = {
  path: 'auth',
  indexRoute: Authentification
}

const signupRoute = {
  path: 'signup',
  indexRoute: Signup
}

const page404Route = {
  path: '404',
  indexRoute: Page404
}

export const createRoutes = (store) => ({
  path        : '/',
  component   : CoreLayout,
  indexRoute  : Home,
  childRoutes : [
    CreatePostRoute,
    CreateTagRoute,
    postRoute,
    tagsRoute,
    tagRoute,
    profileRoute,
    authentificationRoute,
    signupRoute,
    page404Route
  ]
})

export default createRoutes
