const baseURL = import.meta.env.VITE_API_URL as string;

export type Character = {
  id: number;
  name: string;
  birth_year: string;
  eye_color: string;
  gender: string;
  hair_color: string;
  height: string;
  mass: string;
  skin_color: string;
  films: { id: number; title: string }[];
};

export async function index(search?: string): Promise<Character[]> {
  const query = search ? `?search=${search}` : "";
  const res = await fetch(`${baseURL}/people${query}`);
  return res.json();
}

export async function show(id: string): Promise<Character> {
  const res = await fetch(`${baseURL}/people/${id}`);
  return res.json();
}
