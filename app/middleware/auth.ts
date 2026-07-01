export default defineNuxtRouteMiddleware((to, from) => {
  const user = useSupabaseUser()

  // Protect any route starting with /admin
  if (to.path.startsWith('/admin') && !user.value) {
    return navigateTo('/login')
  }
})
