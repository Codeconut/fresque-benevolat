import { usePage } from '@inertiajs/vue3'
import queryString from 'query-string'

// SSR proof
export function useUrlQuery() {
  const page = usePage()
  const url = new URL(page.url, page.props.appUrl)
  return queryString.parse(url.search)
}
