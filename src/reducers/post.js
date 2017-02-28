const post = (state, action) => {
  switch (action.type) {
    case 'PREVIEW_POST':
      return {
        id: action.title,
        text: action.description,
        tags: actions.tags,
        preview: true
      }
    case 'FULL_POST':
      return {
        id: action.title,
        text: action.description,
        tags: actions.tags,
        preview: false
      }
    default:
      return state
  }
}

const posts = (state = [], action) => {
  switch (action.type) {

    //pas super clair
    case 'PREVIEW_POST':
      return [
        ...state,
        post(undefined, action)
      ]
    case 'FULL_POST':
      return state.map(t =>
        post(t, action)
      )
    default:
      return state
  }
}

export default posts