const baseURL = import.meta.env.VITE_API_URL as string;

export type Film = {
  id: number;
  title: string;
  episode_id: string;
  opening_crawl: string;
  characters: { id: number; name: string }[];
};

export async function index(search?: string): Promise<Film[]> {
  const query = search ? `?search=${search}` : "";
  const res = await fetch(`${baseURL}/films${query}`);
  return res.json();
}

export async function show(id: string): Promise<Film> {
  const res = await fetch(`${baseURL}/films/${id}`);
  return res.json();
}
