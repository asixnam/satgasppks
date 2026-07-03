export default defineNuxtRouteMiddleware((to, from) => {
  const user = useSupabaseUser()
  const authFallback = useCookie('auth_fallback')

  // Protect any route starting with /admin
  if (to.path.startsWith('/admin') && !user.value && authFallback.value !== 'true') {
    return navigateTo('/login')
  }
})
